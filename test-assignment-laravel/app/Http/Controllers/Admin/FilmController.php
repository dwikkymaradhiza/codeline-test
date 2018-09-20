<?php

namespace App\Http\Controllers\Admin;

use App\Models\Genre;
use App\Models\Film;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use DB;
use File;
use Validator;
use Auth;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin-lte.film.index');
    }

    /**
     * Get data members.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $films = DB::table('films')
                ->select([
                  DB::raw('@rownum := @rownum + 1 AS rownum'),
                  'id',
                  'name',
                  'rating',
                  'photo',
                  'release_date'
                ])
                ->where('created_by', Auth::id());

        $datatables = Datatables::of($films)
          ->addColumn('action', function ($films) {
              $act = '<a href="'. route("film.show", ['film' => $films->id]) .'"><i class="glyphicon glyphicon-search"></i></a>';
              $act .= ' <a href="'. route("film.edit", ['film' => $films->id]) .'"><i class="glyphicon glyphicon-edit"></i></a>';
              $act .= ' <a href="#"><i data-id="'. $films->id .'" class="delete glyphicon glyphicon-trash"></i></a>';

              return $act;
          })->editColumn('photo', function ($data) {
              $image = '<center><img width="150" src="'. asset('/uploads/avatar.jpeg') .'" /></center>';
              if (!empty($data->photo)) {
                  $image = '<center><a target="_blank" href="'. asset('/uploads/' . $data->photo). '"><img width="150" src="'. asset('/uploads/220_326_' . $data->photo) .'" /></a></center>';
              }

              return $image;
          })
          ->removeColumn('id')
          ->rawColumns(['photo', 'action']);

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', function($query, $keyword) {
                    $sql = '@rownum + 1 like ?';
                    $query->whereRaw($sql, ["%{$keyword}%"]);
            });
        }

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all();

        return view('admin-lte.film.form', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'rating' => 'required',
            'ticket_price' => 'required',
            'photo' => 'required',
            'release_date' => 'required',
            'genres' => 'required'
          ]);
  
          if ($validator->fails()) {
              return redirect()->back()->withInput()->withErrors($validator);
          }
  
          DB::beginTransaction();
          try {
            $film = new Film;
            $film->name = $request->name;
            $film->description = $request->description;
            $film->rating = $request->rating;
            $film->ticket_price = $request->ticket_price;
            $film->created_by = Auth::id();
            $film->release_date = Carbon::createFromFormat('m/d/Y', $request->release_date)->format('Y-m-d');
  
            if($request->hasFile('photo') && $request->file('photo')->isValid()){
                $file = $request->file('photo');
                $fileName = 'film-'. str_slug($request->name, '-') . '-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
  
                $thumbnailPath = public_path('uploads/220_326_' . $fileName);
                Image::make($file->getRealPath())->fit(220, 326)->save($thumbnailPath);
  
                $originalPath = public_path('uploads/' . $fileName);
                Image::make($file->getRealPath())->save($originalPath);
  
                $film->photo = $fileName;
            }
  
            $film->save();
            $film->genres()->attach($request->genres);
  
            DB::commit();
            return redirect()->route('film.index')->with('status', 'Data saved successfully!');
          } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $film = Film::findOrFail($id);
        if(!empty($film->release_date)) {
            $film->release_date = Carbon::createFromFormat('Y-m-d', $film->release_date)->format('m/d/Y');
        }

        return view('admin-lte.film.detail', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $film = Film::findOrFail($id);
        $genres = Genre::all();

        if(!empty($film->release_date)) {
            $film->release_date = Carbon::createFromFormat('Y-m-d', $film->release_date)->format('m/d/Y');
        }

        return view('admin-lte.film.form', compact('film', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'rating' => 'required',
            'ticket_price' => 'required',
            'release_date' => 'required',
            'genres' => 'required'
          ]);
  
          if ($validator->fails()) {
              return redirect()->back()->withInput()->withErrors($validator);
          }
    
          DB::beginTransaction();
          try {
            $film = Film::find($id);
            if ($request->hasFile('photo') && $request->file('photo')->isValid()){
                $oldPhotoPath = public_path('uploads/' . $film->photo);
                $oldThumbnailPhotoPath = public_path('uploads/220_326_' . $film->photo);
    
                $file = $request->file('photo');
                $fileName = 'film-'. str_slug($request->name, '-') . '-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
    
                $thumbnailPath = public_path('uploads/220_326_' . $fileName);
                Image::make($file->getRealPath())->fit(220, 326)->save($thumbnailPath);
    
                $originalPath = public_path('uploads/' . $fileName);
                Image::make($file->getRealPath())->save($originalPath);
    
                $film->photo = $fileName;
            }

            $film->name = $request->name;
            $film->description = $request->description;
            $film->rating = $request->rating;
            $film->ticket_price = $request->ticket_price;
            $film->release_date = Carbon::createFromFormat('m/d/Y', $request->release_date)->format('Y-m-d');

            if (!empty($request->genres)) {
                $film->genres()->sync([]);
                $film->genres()->attach($request->genres);
            }

            $film->save();

            DB::commit();
            if (isset($oldPhotoPath) && File::exists($oldPhotoPath)) {
                File::delete($oldPhotoPath);
                File::delete($oldThumbnailPhotoPath);
            }

            return redirect()->route('film.index')->with('status', 'Data updated successfully!');
          } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
          $film = Film::where('id', $id)->firstOrFail();
          $photoPath = public_path('uploads/' . $film->photo);
          $thumbnailPhotoPath = public_path('uploads/220_326_' . $film->photo);

          if ($film->delete()) {
            if (File::exists($photoPath)) {
                File::delete($photoPath);
                File::delete($thumbnailPhotoPath);
            }
          }

          DB::commit();
          return response()->json([]);
        } catch (\Exception $e) {
          DB::rollBack();
          return response()->json([], $e->getStatusCode());
        }
    }
}

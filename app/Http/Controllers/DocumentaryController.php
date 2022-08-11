<?php

namespace App\Http\Controllers;
use App\Models\Documentary;

use Illuminate\Http\Request;

class DocumentaryController extends Controller
{


   
   public function getById($idDocumentary)
   {

      $documentaries = Documentary::select('name','category','synopsis','link')
         ->where('id_documentary', $idDocumentary)->first();
      if ($documentaries) {
         return response()->json($documentaries, 200);
      } else {
         return response()->json(['message' => 'Id Not Found!'], 404);
      }
   }

    public function getAll()
    {
       $documentaries = Documentary::select('name','category','synopsis','link')
       ->orderBy('name')
       ->get();
       if ($documentaries) {
          return response()->json($documentaries, 200);
       } else {
          return response()->json(['message' => 'List Not found!'], 404);
       }
    }

    public function delete($idDocumentary)
    {
 
       $count = Documentary::where('id_documentary', $idDocumentary)->delete();
       // dd($data);
       if ($count > 0) {
 
          return response()->json(['message' => 'Successfully Deleted']);
       } else {
          return response()->json(['message' => 'Delete Failed']);
       }
    }

    public function store(Request $request) {
        //rules - soon
       $documentary = new Documentary();
       $documentary ->name = $request->name;
       $documentary ->synopsis = $request->synopsis;
       $documentary ->category = $request->category;
       $documentary ->link = $request->link;
       $documentary ->save();
       if($documentary)
         return response()->json(['message' => 'Successfully Store']);
       else{
         return response()->json(['message' => 'Store Failed']);
       }

    }

    public function update(Request $request, int $id)
    {    //rules - soon
      $documentary = Documentary::find($id);
      $documentary ->name = $request->name;
      $documentary ->synopsis = $request->synopsis;
      $documentary ->category = $request->category;
      $documentary ->link = $request->link;
      $documentary ->update();
      if($documentary)
      return response()->json(['message' => 'Successfully Updated']);
    else{
      return response()->json(['message' => 'Updated Failed']);
    }
   }
}

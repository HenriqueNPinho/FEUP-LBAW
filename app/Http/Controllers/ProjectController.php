<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Shows the card for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $project = Project::find($id);
      $this->authorize('show', $project);
      return view('pages.project', ['project' => $project]);
    }

    /**
     * Shows all cards.
     *
     * @return Response
     */
    public function list()
    {
      if (!Auth::check()) return redirect('/login');
      $this->authorize('list', Project::class);
      $projects = Auth::user()->projects()->orderBy('id')->get();
      return view('pages.projects', ['projects' => $projects]);
    }

    /**
     * Creates a new card.
     *
     * @return Card The card created.
     */
    // public function create(Request $request)
    // {
    //   $card = new Card();

    //   $this->authorize('create', $card);

    //   $card->name = $request->input('name');
    //   $card->user_id = Auth::user()->id;
    //   $card->save();

    //   return $card;
    // }

    // public function delete(Request $request, $id)
    // {
    //   $card = Card::find($id);

    //   $this->authorize('delete', $card);
    //   $card->delete();

    //   return $card;
    // }
}

<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
  /**
   * Creates a new item.
   *
   * @param  int  $card_id
   * @param  Request request containing the description
   * @return Response
   */
  // public function create(Request $request, $card_id)
  // {
  //   $item = new Item();
  //   $item->card_id = $card_id;
  //   $this->authorize('create', $item);
  //   $item->done = false;
  //   $item->description = $request->input('description');
  //   $item->save();
  //   return $item;
  // }

    /**
     * Updates the state of an individual item.
     *
     * @param  int  $id
     * @param  Request request containing the new state
     * @return Response
     */
    public function updateStatus(Request $request, $id)
    {
      $task = Task::find($id);
      $this->authorize('update', $task);
      if($request->input('status')=='Not Started' || $request->input('status')=='In Progress' | $request->input('status')=='Complete'){
        $task->status = $request->input('status');
        $task->save();
      }
      return $task;
    }

    /**
     * Deletes an individual item.
     *
     * @param  int  $id
     * @return Response
     */
    // public function delete(Request $request, $id)
    // {
    //   $item = Item::find($id);
    //   $this->authorize('delete', $item);
    //   $item->delete();
    //   return $item;
    // }

}

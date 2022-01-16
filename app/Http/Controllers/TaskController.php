<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use App\Models\TaskComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
  /**
   * Creates a new item.
   *
   * @param  int  $project_id
   * @param  Request request containing the description
   * @return Response
   */
	public function create(Request $request, $project_id)
	{
        if (!Auth::check()) return redirect('/login');
		$task = new Task();
		$task->project_id = $project_id;
		$this->authorize('create', $task);
		$task->status = $request->input('status');
		$task->name = $request->input('name');
		$task->delivery_date = $request->input('date');
		$task->description = $request->input('description');
		$members=$request->input('members');
		
		$task->save();
		if($members!=""){
			$assignedMembersIDs = explode(",", $members);
			foreach($assignedMembersIDs as $memberID){
				$task->members()->attach($memberID,['assigned_by_id'=>Auth::id()]);
			}
		}
		
		return $task;
	}

	public function get($task_id)
	{
        if (!Auth::check()) return redirect('/login');
		$task = Task::with(['members','comments'])->find($task_id);
		$this->authorize('access', $task);
		return $task;
	}


  /**
   * Updates the state of an individual item.
   *
   * @param  int  $id
   * @param  Request request containing the new state
   * @return Response
   */
	public function updateStatus(Request $request, $id)
	{
        if (!Auth::check()) return redirect('/login');
		$task = Task::find($id);
		$this->authorize('update', $task);
		if($request->input('status')=='Not Started' || $request->input('status')=='In Progress' | $request->input('status')=='Complete'){
			$task->status = $request->input('status');
			$task->save();
		}
		return $task;
	}

	public function edit(Request $request, $id)
	{
        if (!Auth::check()) return redirect('/login');
		$task = Task::find($id);
		$this->authorize('update', $task);
		$task->name = $request->input('name');
        if($task->delivery_date!=$request->input('date'))
		    $task->delivery_date = $request->input('date');
		$task->description = $request->input('description');
		$members=$request->input('members');
        $task->members()->detach();
		
		if($members!=""){
			$assignedMembersIDs = explode(",", $members);
			foreach($assignedMembersIDs as $memberID){
				$task->members()->attach($memberID,['assigned_by_id'=>Auth::id()]);
			}
		}
        $task->save();
		return $task;
	}

	/**
	 * Deletes an individual item.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
        if (!Auth::check()) return redirect('/login');  
        $task = Task::find($id);
        $this->authorize('delete', $task);
        $task->delete();
        return $task;
	}
	

    public function addComment(Request $request, $task_id)
    {
        if (!Auth::check()) return redirect('/login');  
        $task = Task::find($task_id);
        $this->authorize('update', $task);
        $commentContent=$request->input("content");
        $taskComment = new TaskComment();
        $taskComment->task_id=$task_id;
        $taskComment->project_member_id=Auth::id();
        $taskComment->content=$commentContent;
        
        $taskMembers=$task->members()->get();
        foreach($taskMembers as $member){
            $member->pivot->new_comment=TRUE;
            $member->pivot->save();
            $member->save();
        }
        $taskComment->save();
        return;
    }

}

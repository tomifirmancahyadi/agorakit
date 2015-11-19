<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
  public function __construct()
  {
    $this->middleware('member', ['only' => ['reply', 'create', 'store', 'edit', 'update', 'destroy']]);
  }


  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
  }

  public function reply(Request $request, $group_id, $discussion_id)
  {
    $comment = new \App\Comment();
    $comment->body = clean($request->input('body'));
    $comment->user()->associate(\Auth::user());

    if ($comment->isInvalid())
    {
      return redirect()->back()
      ->withErrors($comment->getErrors())
      ->withInput();
    }

    $discussion = \App\Discussion::findOrFail($discussion_id);
    $discussion->comments()->save($comment);
    ++$discussion->total_comments;
    $discussion->save();
    $group = $discussion->group;

    return redirect()->action('DiscussionController@show', [$group->id, $discussion->id]);
  }


  /**
  * Display the specified resource.
  *
  * @param int $id
  *
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param int $id
  *
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param \Illuminate\Http\Request $request
  * @param int                      $id
  *
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param int $id
  *
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
  }
}

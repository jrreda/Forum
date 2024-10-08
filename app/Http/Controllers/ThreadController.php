<?php

namespace App\Http\Controllers;

use App\Filters\ThreadFilters;
use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Channel $channel
     * @param  \App\Filters\ThreadFilters $filters
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel, ThreadFilters $filters)
    {
        $threads = $this->getThreads($channel, $filters);

        if (request()->wantsJson()) {
            return $threads;
        }

        return view('thread.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('thread.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title'      => ['required'],
            'body'       => ['required'],
            'channel_id' => ['required', 'exists:channels,id'],
        ]);

        $thread = Thread::create([
            'user_id'    => auth()->id(),
            'channel_id' => request('channel_id'),
            'title'      => $request->title,
            'body'       => $request->body,
        ]);

        return redirect($thread->path())->with('success', 'Your thread has been published!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @param  integer $channelId
     * @return \Illuminate\Http\Response
     */
    public function show($channelId, Thread $thread)
    {
        return view('thread.show', [
            'thread'  => $thread,
            'replies' => $thread->replies()->paginate(20),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Channel $channel
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel, Thread $thread)
    {
        // Authgorize, Solution #1
        // if ($thread->user_id != auth()->id()) {
        //     abort(403, 'You are not allowed to delete this thread');
        // }
        $this->authorize('update', $thread);

        // $thread->replies()->delete(); // solution #2 after db cascade on delete
        $thread->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect('/threads');
    }
    
    /**
     * get filtered Threads
     *
     * @param  \App\Models\Channel $channel
     * @param  \App\Filters\ThreadFilters $filters
     * @return void
     */
    protected function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::latest()->filter($filters);

        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

        return $threads->get();
    }
}

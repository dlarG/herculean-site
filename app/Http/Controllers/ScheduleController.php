<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class ScheduleController extends Controller
{
    public function index()
    {
        $auditions = Announcement::with(['coach', 'category'])
            ->where('type', 'audition')
            ->whereNotNull('event_at')
            ->orderBy('event_at')
            ->get();

        // Shape the data for the calendar + modal
        $payload = $auditions->map(function ($a) {
            return [
                'id'            => $a->id,
                'title'         => $a->title,
                'body'          => $a->body,
                'event_at'      => $a->event_at->toIso8601String(),
                'event_date'    => $a->event_at->format('Y-m-d'),
                'event_time'    => $a->event_at->format('g:i A'),
                'location'      => $a->location,
                'type'          => $a->type,
                'image_url'     => $a->image_path ? \Illuminate\Support\Facades\Storage::url($a->image_path) : null,
                'coach_name'    => $a->coach->name ?? 'Unknown coach',
                'coach_username'=> $a->coach->username ?? '',
                'category_name' => $a->category->name ?? 'General',
                'category_group'=> $a->category->group ?? '',
            ];
        });

        // Group by date for quick calendar lookups
        $byDate = $payload->groupBy('event_date');

        return view('schedule', compact('payload', 'byDate'));
    }
}
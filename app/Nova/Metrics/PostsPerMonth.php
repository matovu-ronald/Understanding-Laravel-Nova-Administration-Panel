<?php

namespace App\Nova\Metrics;

use App\Post;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Trend;
use Laravel\Nova\Metrics\TrendResult;

class PostsPerMonth extends Trend
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        // return (new TrendResult)->trend([
        //     'Day 1' => 1,
        //     'Day 2' => 35,
        //     'Day 3' => 120,
        //     'Day 4' => 40,
        //     'Day 5' => 10,
        // ]);
        return $this->countByMonths($request, Post::class)
            ->showLatestValue()
            ->suffix('Posts');
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            6 => '6 Months',
            12 => '12 Months',
            24 => '24 Months',
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'posts-per-month';
    }
}

<?php

namespace App\Nova;

use App\Nova\Actions\PublishPost;
use App\Nova\Filters\PostCategories;
use App\Nova\Filters\PostPublished;
use App\Nova\Lenses\MostTags;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Post extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Post';

    public static $globallySearchable = true;

    // /**
    //  * The single value that should be used to represent the resource when being displayed.
    //  *
    //  * @var string
    //  */
    // public static $title = 'title';
    public function title()
    {
        return $this->title. ' - ' . $this->category->name;
    }

    public function subtitle()
    {
        return 'Author: '. $this->user->name;
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        // Show posts that belong only to the logged in user
        return $query->where('user_id', $request->user()->id);
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'body'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Category')
                ->sortable(),

            Text::make('Title')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:posts,title')
                ->updateRules('unique:posts,title,{{resourceId}}'),

            Trix::make('Body')
                ->nullable(),

            DateTime::make('Publish At')
                ->hideFromIndex()
                ->rules('after_or_equal:today'),

            DateTime::make('Publish Until')
                ->hideFromIndex()
                ->rules('after_or_equal:published_at'),

            Boolean::make('Is Published')
                ->sortable()
                ->canSee(function($request) {
                    // return $request->user()->can('publish_post', $this);
                    return true;
                }),

            BelongsTo::make('User')
                ->sortable()
                ->searchable(),

            BelongsToMany::make('Tags')

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            (new PostCount)->width('1/2'),
            (new PostsPerCategory)->width('1/2'),
            (new PostsPerMonth)->width('full'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new PostPublished,
            new PostCategories
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [
            new MostTags
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            (new PublishPost)
                ->showOnTableRow()
                ->confirmText('Are sure you want to publish this post?')
                ->confirmButtonText('Yes, Publish Post')
                ->cancelButtonText('No, Don\'t Publish Post')
                ->canSee(function($request) {
                    // return $request->user()->id == 1;
                    return true;
                })
                ->canRun(function($request, $post) {
                    return $post->id === 2;
                })
        ];
    }
}

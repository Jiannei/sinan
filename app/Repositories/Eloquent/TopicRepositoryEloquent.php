<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\TopicRepository;
use App\Repositories\Criteria\RequestCriteria;
use App\Repositories\Models\Topic;
use App\Repositories\Validators\TopicValidator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class TopicRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class TopicRepositoryEloquent extends BaseRepository implements TopicRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Topic::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        // $this->pushCriteria(app(TopicCriteria::class));
    }

    // 查询限定时间范围（$pass_days）内，有发表过话题的用户
    public function queryPastUsers($passDays)
    {
        return $this->model::query()->select(DB::raw('user_id, count(*) as topic_count'))
            ->where('created_at', '>=', Carbon::now()->subDays($passDays))
            ->groupBy('user_id')
            ->get();
    }
}

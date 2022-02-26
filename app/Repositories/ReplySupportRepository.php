<?php



namespace App\Repositories;

use App\Models\ReplySupport;
use App\Repositories\Traits\RepositoryTrait;
use Illuminate\Support\Arr;

class ReplySupportRepository
{
    use RepositoryTrait;

    protected $entity;

    public function __construct(ReplySupport $model)
    {
        $this->entity = $model;
    }


    public function createReplyTosupportId(string $supportId, array $data)
    {
        $user = $this->getUserAuth();

        $support = app(SupportRepository::class)->getSupport($supportId);

        return $support
                        ->replies()
                        ->create([
                        'description' => $data['description'],
                        'user_id' => $user->id,
                        ]);;
    }

}
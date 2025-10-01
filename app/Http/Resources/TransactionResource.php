<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'time' => $this->time->format('Y-m-d'),
            'category_name' => $this->category ? $this->category->name : null,
            'account_name' => $this->account ?  $this->account->name : null,
            'member_name' => $this->member ?  $this->member->name : null,
            'tag_name' => $this->tag ?  $this->tag->name : null,
            'note' => $this->note ?? '',
            'type' => $this->type ?? null,
            'user_name' => $this->user->name,
        ];
    }
}

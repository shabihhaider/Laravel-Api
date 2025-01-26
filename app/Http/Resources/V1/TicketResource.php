<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // modify json structure
        return [
            'type' => 'ticket',
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'description' => $this->when(
                    $request->routeIs('tickets.show'),  // Condition when description must show
                    $this->description
                ),
                'status' => $this->status,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at
            ],
            'relationships' => [
                'author' => [
                    'data' => [
                        'type' => 'user',
                        'id' => $this->user_id
                    ],
                    'links' => [
                        'self' => route('users.show', ['user' => $this->user_id])
                    ]
                ]
            ],
            // Make it optional
            'includes' => new UserResource($this->whenLoaded('author')), // Load the user relationship when it is included otherwise it will completely omit the user relationship and display only the ticket resource (http://127.0.0.1:8000/api/v1/tickets/1?include=author)
            'links' => [
                'self' => route('tickets.show', ['ticket' => $this->id])
            ]
        ];
    }
}

// Make User resource, model, controller, requests
// php artisan make:controller Api\V1\UserController --resource --model=User --requests
// php artisan make:resource V1\UserResource
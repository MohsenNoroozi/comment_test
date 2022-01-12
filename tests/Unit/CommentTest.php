<?php

namespace Tests\Unit;

use App\Models\Comment;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Check if it can get all comments
     */
    public function test_can_list_comments()
    {
        $this->getJson(route('api.comments.index'))
            ->assertStatus(200)
            ->assertJsonStructure([]);
    }

    /**
     * Check if it can store a comment
     */
    public function test_can_store_a_comment()
    {
        $user_name = $this->faker->name;
        $comment_text = $this->faker->text(120);

        $this->postJson(route('api.comments.store'), [
            'user_name' => $user_name,
            'comment_text' => $comment_text,
        ])
            ->assertStatus(201)
            ->assertJsonPath('user_name', $user_name)
            ->assertJsonPath('comment_text', $comment_text);
    }

    /**
     * Check if it can validate required user_name for storing a comment
     */
    public function test_can_validate_required_user_name_for_storing_a_comment()
    {
        $this->postJson(route('api.comments.store'), [
            'user_name' => null,
            'comment_text' => $this->faker->text(120),
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('user_name');
    }

    /**
     * Check if it can validate required comment_text for storing a comment
     */
    public function test_can_validate_required_comment_text_for_storing_a_comment()
    {
        $this->postJson(route('api.comments.store'), [
            'user_name' => $this->faker->name,
            'comment_text' => null,
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('comment_text');
    }

    /**
     * Check if it can reply to a comment
     */
    public function test_can_reply_to_a_comment()
    {
        $comment = Comment::create([
            'user_name' => $this->faker->name,
            'comment_text' => $this->faker->text(120),
        ]);

        $user_name = $this->faker->name;
        $comment_text = $this->faker->text(120);
        $parent_id = $comment->id;

        $this->postJson(route('api.comments.reply'), [
            'user_name' => $user_name,
            'comment_text' => $comment_text,
            'parent_id' => $parent_id,
        ])
            ->assertStatus(201)
            ->assertJsonPath('user_name', $user_name)
            ->assertJsonPath('comment_text', $comment_text)
            ->assertJsonPath('parent_id', $parent_id)
            ->assertJsonStructure([
                'children' => []
            ]);
    }

    /**
     * Check if it can validate required user_name for replying to a comment
     */
    public function test_can_validate_required_user_name_for_replying_to_a_comment()
    {
        $comment = Comment::create([
            'user_name' => $this->faker->name,
            'comment_text' => $this->faker->text(120),
        ]);
        $this->postJson(route('api.comments.reply'), [
            'user_name' => null,
            'comment_text' => $this->faker->text(120),
            'parent_id' => $comment->id,
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('user_name');
    }

    /**
     * Check if it can validate required comment_text for replying to a comment
     */
    public function test_can_validate_required_comment_text_for_replying_to_a_comment()
    {
        $comment = Comment::create([
            'user_name' => $this->faker->name,
            'comment_text' => $this->faker->text(120),
        ]);
        $this->postJson(route('api.comments.reply'), [
            'user_name' => $this->faker->name,
            'comment_text' => null,
            'parent_id' => $comment->id,
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('comment_text');
    }

    /**
     * Check if it can validate required parent_id for replying to a comment
     */
    public function test_can_validate_required_parent_id_for_replying_to_a_comment()
    {
        $comment = Comment::create([
            'user_name' => $this->faker->name,
            'comment_text' => $this->faker->text(120),
        ]);
        $this->postJson(route('api.comments.reply'), [
            'user_name' => $this->faker->name,
            'comment_text' => $this->faker->text(120),
            'parent_id' => null,
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('parent_id');
    }
}

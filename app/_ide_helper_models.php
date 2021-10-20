<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Audience
 *
 * @property int $id
 * @property string $subscriber_id
 * @property string $feed_id
 * @property-read \App\Models\Feed $feed
 * @property-read \App\Models\Subscriber $subscriber
 * @method static \Database\Factories\AudienceFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Audience newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Audience newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Audience query()
 * @method static \Illuminate\Database\Eloquent\Builder|Audience whereFeedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audience whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audience whereSubscriberId($value)
 */
	class Audience extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Feed
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property \Illuminate\Support\Carbon $pubDate
 * @property string $image
 * @property string $guid
 * @property int $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscriber[] $subscribers
 * @property-read int|null $subscribers_count
 * @method static \Database\Factories\FeedFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feed query()
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereGuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed wherePubDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereTitle($value)
 */
	class Feed extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subscriber
 *
 * @property string $id
 * @property string $name
 * @property string $phone
 * @property bool $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Audience[] $audience
 * @property-read int|null $audience_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Feed[] $feeds
 * @property-read int|null $feeds_count
 * @method static \Database\Factories\SubscriberFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber whereStatus($value)
 */
	class Subscriber extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}


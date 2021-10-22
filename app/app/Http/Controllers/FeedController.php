<?php

namespace App\Http\Controllers;

use App\Events\SaveFeedEvent;
use App\Http\Resources\AudienceRequest;
use App\Http\Resources\AudienceResource;
use App\Models\Audience;
use App\Models\Feed;
use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use XMLReader;

class FeedController extends Controller
{
    public function createFeedEntity()
    {

        $g1 = json_decode(json_encode(simplexml_load_file('https://g1.globo.com/rss/g1/', null, LIBXML_NOCDATA)));
        $data = $g1->channel->item;

        foreach($data as $item) {
            preg_match("/\<img.+src\=(?:\"|\')(.+?)(?:\"|\')(?:.+?)\>/", $item->description, $out);
            $description = substr(str_replace('   <br />   ', '', str_replace($out, '', $item->description)), 0, 350);
            $image = array_pop($out) ?: "https://s2.glbimg.com/veNWQCjPmWVRAfzfLSJt35f_V58=/i.s3.glbimg.com/v1/AUTH_afd7a7aa13da4265ba6d93a18f8aa19e/pox/g1.png";

            $feed = Feed::findOrCreate($item->title);
            $feed->title = $item->title;
            $feed->guid = $item->guid;
            $feed->pubDate = $item->pubDate;
            $feed->status = 1;
            $feed->image = $image;
            $feed->description = substr($description, 0, strrpos($description, ' ')).'[...]';
            $feed->save();
        };

        return redirect('admin/inscritos');
    }

    public function showFeedEntity(Feed $feed)
    {
        return $feed;
    }

    public function evento(Request $request)
    {
        event(new SaveFeedEvent($request->id));
        return back();
    }

    public function confirmFeedEntity(Subscriber $subscriber, Feed $feed)
    {
        $audience = new Audience();
        $audience->subscriber_id = $subscriber->id;
        $audience->feed_id = $feed->id;
        $audience->save();

        return Audience::all();
        // return redirect($feed->guid);
    }

    public function subscriberFeedEntity(Request $request)
    {
        $subscriber = Subscriber::with('feeds')->find($request->id);


        return $feeds;
        // dd($a, $subscriber);
        // return new AudienceResource(Subscriber::with('feeds')->find($request->id));
    }

    // public function subscriberFeedEntity(Subscriber $subscriber)
    // {
    //     $item = $subscriber::with('feeds')->paginate();

    //     return $item;
    // }
}

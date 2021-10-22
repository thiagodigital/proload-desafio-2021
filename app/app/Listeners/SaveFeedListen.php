<?php

namespace App\Listeners;

use App\Events\SaveFeedEvent;
use App\Models\Feed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SaveFeedListen
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
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
        Mail::subject('asdasd')
            ->to('teste@site.com')
            ->send();
    }
}

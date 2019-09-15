<?php

namespace App\Services;

class DiscordEmbedService
{
    public function makeTweetEmbed(array $parameters) :array
    {
        $media = [
            'url' => isset($parameters['extended_entities']) ? $parameters['extended_entities']['media'][0]['media_url_https'] : null,
        ];

        return [
            'author' => [
                'name' => $parameters['user']['name'],
                'url' => 'https://twitter.com/' . $parameters['user']['screen_name'],
                'icon_url' => $parameters['user']['profile_image_url_https'],
            ],
            'url' => 'http://lamegaforge.fr',
            'description' => $parameters['text'],
            'color' => 14370374,
            'image' => $media
        ];
    }
}

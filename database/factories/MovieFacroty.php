<?php

use Faker\Generator as Faker;

$factory->define(App\Movie::class, function (Faker $faker) {
    return [
        'name' => "name",
        'year' => "1999",
        'dir' =>  "Светлана Баскова",
        'time' => "86",
        'img' => 'https://st.kp.yandex.net/images/film_iphone/iphone360_373314.jpg',
        'kinopoisk_id' => '373314',
        'background_img' => 'https://24smi.org/public/media/2018/6/21/slonik2.jpg',
        'desk' => 'Тема фильма — отношения между армейскими офицерами в условиях закрытого общества военной части. Два главных героя — младшие офицеры, находящиеся на гауптвахте, сидя в одной камере, вынуждены решать острые социальные и психологические проблемы в небольшом пространстве. Реалистичность диалогов и декораций взрывается внутренним абсурдом поступков и брутальностью мотиваций персонажей.'
    ];
});
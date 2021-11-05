<?php

use Synext\Requests\Http;

if(Http::methods("GET")){
    echo "je suis applele en get";
}else if(Http::methods("POST")){
    echo "je suis appler e post";
}else if(Http::methods("DELETE")){
    echo "je suis appler en delete";
}

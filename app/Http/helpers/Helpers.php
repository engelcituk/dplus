<?php

function setActiveRoute($name){
   
    return request()->routeIs($name) ? 'active' : '';
}

function setCollapseShow($name){
   
    return request()->routeIs($name) ? 'active open' : '';
}
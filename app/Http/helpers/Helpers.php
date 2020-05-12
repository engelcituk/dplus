<?php

function setActiveRoute($name){
   
    return request()->routeIs($name) ? 'active' : '';
}

function setCollapseShow($name){
   
    return request()->routeIs($name) ? 'active open' : '';
}
function setSiNo($disponible){
   
    return $disponible ? 
            '<span class="badge badge-success">Sí</span>' : 
            '<span class="badge badge-danger">No</span>' ;
}


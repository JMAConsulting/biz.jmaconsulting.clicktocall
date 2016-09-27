<?php

  
function smarty_modifier_telephone($params) {
  $html = "<a href='#' data-phone={$params} class='phone_number'>{$params}</a>";
  return $html;
}
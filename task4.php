<?php

require('./dump.php');

/**
 * @param array $tag_list - array with html structure.
 * @return bool true if the structure is correct, false otherwise.
 */
function validate_html($tag_list): bool
{
  $tag_depth_list = [];
  foreach ($tag_list as $tag) {
    if (preg_match('/^<\/.+>$/', $tag)) { // closing tags
      $tagName = substr($tag, 2, strlen($tag) - 3);
      $lastIndex = count($tag_depth_list) - 1;
      if ($tagName === $tag_depth_list[$lastIndex]) {
        unset($tag_depth_list[$lastIndex]);
        $tag_depth_list = array_values($tag_depth_list);
        continue;
      }

      return false;

    } elseif (preg_match('/^<.*[^\/]>$/', $tag)) { // opening tags

      $tagName = substr($tag, 1, strlen($tag) - 2);
      $tag_depth_list[] = $tagName;

    } elseif (preg_match('/^<.+\/>$/', $tag)) { // single tags
      continue;
      
    } else { // something extraneous )))
      return false;
    }
  }

  if (count($tag_depth_list) !== 0) {
    return false;
  }

  return true;
}

$tag_list = ["<a>", "<div>", "<span>", "<hr />", "</span>", "<br/>", "<span>", "</span>", "</div>", "</a>"];

echo validate_html($tag_list);

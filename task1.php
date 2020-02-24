<?php

/**
 * @param array $categories - The array of cattegories to search in.
 * @param int $id - The id of the category to search.
 * @return mixed the name of the searched category or false if not found.
 */
function search_category($categories, int $id)
{
  for ($i = 0; $i < count($categories); $i++) {
    if ($id === $categories[$i]['id']) {
      return $categories[$i]['title'];
    }
    if ($categories[$i]['children']) {
      $title = search_category($categories[$i]['children'], $id);
      if ($title) {
        return $title;
      }
    }
  }

  return false;
}

$categories = array(
  array(
    "id" => 1,
    "title" => "Обувь",
    'children' => array(
      array(
        'id' => 2,
        'title' => 'Ботинки',
        'children' => array(
          array('id' => 3, 'title' => 'Кожа'),
          array(
            'id' => 4,
            'title' => 'Текстиль',
            'children' => array(
              array('id' => 17, 'title' => 'Категория №17')
            )
          ),
        ),
      ),
      array('id' => 5, 'title' => 'Кроссовки',),
    )
  ),
  array(
    "id" => 6,
    "title" => "Спорт",
    'children' => array(
      array(
        'id' => 7,
        'title' => 'Мячи'
      )
    )
  ),
);

echo search_category($categories, 1);

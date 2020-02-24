<?php

/**
 * @param array $categories - The array of cattegories to search in.
 * @param int $id - The id of the category to search.
 * @return mixed the name of the searched category or false if not found.
 */
function search_category($categories, int $id)
{
  foreach ($categories as $category) {
    if ($id === $category['id']) {
      return $category['title'];
    }
    if ($category['children']) {
      $title = search_category($category['children'], $id);
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

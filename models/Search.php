<?php
//если мы получили что-то через $_POST
if (isset($_POST['search']))
{
    // включим соединение с базой
    include('db.php');
    $db = new db();
    // всегда фильтруйте входящую информацию, чтобы обойти SQL инъекции
    $word = mysql_real_escape_string($_POST['search']);
    // формирование поискового запроса к базе
    $sql = 'SELECT name, FROM product ' . $word . "%' ORDER BY title LIMIT 10";
    // получение результатов
    $row = $db->select_list($sql);
    if(count($row)) 
    {
        $end_result = '';
        foreach($row as $r)
        {
            $result = $r['title'];
            // выделим найденные слова
            $bold = '<span class="found">' . $word . '</span>';
            $end_result .= '<li>' . str_ireplace($word, $bold, $result) . '</li>';
        }
        echo $end_result;
    }
    else
    {
        echo '<li>No results found</li>';
    }
}
?>
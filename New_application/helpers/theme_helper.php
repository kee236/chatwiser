// application/helpers/theme_helper.php
function get_theme_color_code($theme_name)
{
    $colors = [
        'purple' => '#545096',
        'blue' => '#1193D4',
        'white' => '#303F42',
        'black' => '#1A2226',
        'green' => '#00A65A',
        'red' => '#E55053',
        'yellow' => '#F39C12'
    ];
    return $colors[$theme_name] ?? '#545096'; // ค่าเริ่มต้น
}

function load_theme_view($view_name, $current_theme = 'modern')
{
    $file_path = "views/" . $view_name;
    if (file_exists(APPPATH . $file_path)) {
        return $view_name;
    }
    return 'site/modern/' . basename($view_name); // Fallback
}

<?php

if (!defined('ABSPATH'))
    exit;
responsive_tabs_with_accordions_user_capabilities();

$styledata = Array('id' => 14, 'style_name' => 'style14', 'css' => 'heading-font-size |20| heading-font-color |#949494| heading-font-active-color |#ffffff| heading-background-active-color |rgba(44, 184, 179, 1)| heading-font-familly |Open+Sans| heading-font-weight |500| heading-text-align |center| heading-width |200| heading-padding |15| heading-icon-size |20| heading-margin-bottom |15| heading-border-radius |20| heading-box-shadow-Blur |10| heading-box-shadow-color |rgba(212, 212, 212, 1)| content-font-size |16| content-font-color |#8c8c8c| content-background-color |rgba(255, 255, 255, 1)| content-padding-top |30| content-padding-right |30| content-padding-bottom |30| content-padding-left |30|content-line-height |1.5| content-font-familly |Open+Sans| content-font-weight |300| content-font-align |center| content-border-radius |5|content-box-shadow-Blur |10| content-box-shadow-color |rgba(214, 214, 214, 1)| heading-font-style |normal| content-box-shadow-Horizontal |0| content-box-shadow-Vertical |0| content-box-shadow-Spread |0| heading-box-shadow-Horizontal |0| heading-box-shadow-Vertical |0| heading-box-shadow-Spread |0| custom-css ||||||||||');
$listdata = Array(
    0 => Array('id' => 1, 'styleid' => 14, 'title' => 'Default Title', 'files' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fringilla id sem ut tempor. Nullam nec lorem in diam iaculis varius eget a neque. Sed posuere volutpat eros, non lobortis nisl molestie interdum. Vivamus eleifend faucibus erat ac imperdiet. Aliquam et orci aliquam, placerat metus eget, vehicula neque. Aliquam augue leo, dapibus vitae urna iaculis, euismod interdum neque. In tempus iaculis magna sit amet vehicula. Aliquam erat volutpat. Pellentesque vel fermentum quam. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p> <p>&nbsp;</p> <p>Proin sit amet pretium purus. Praesent in laoreet justo. Aenean non porttitor lacus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In vitae neque elit. In sed auctor diam. Aenean sit amet posuere quam. Ut ac neque ut tellus dapibus aliquam vel id mauris. Donec arcu sapien, consequat a porta non, porttitor quis est. Nunc in diam fringilla, euismod erat id, malesuada neque. Sed lorem turpis, faucibus non magna nec, sodales ultrices tellus. Sed convallis orci a tortor laoreet, vitae lobortis arcu tempus. Pellentesque in lobortis justo.</p>', 'css' => VcTabsAdminFontAwesomeData('book')),
    1 => Array('id' => 2, 'styleid' => 14, 'title' => 'Default Title', 'files' => '<p>Proin sit amet pretium purus. Praesent in laoreet justo. Aenean non porttitor lacus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In vitae neque elit. In sed auctor diam. Aenean sit amet posuere quam. Ut ac neque ut tellus dapibus aliquam vel id mauris. Donec arcu sapien, consequat a porta non, porttitor quis est. Nunc in diam fringilla, euismod erat id, malesuada neque. Sed lorem turpis, faucibus non magna nec, sodales ultrices tellus. Sed convallis orci a tortor laoreet, vitae lobortis arcu tempus. Pellentesque in lobortis justo.</p> <p>&nbsp;</p> <p>Sed ac auctor urna. Proin quis arcu quam. Nullam sit amet libero id metus laoreet rhoncus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus et lobortis justo. Donec tempus mollis porttitor. Nullam condimentum erat eu ullamcorper viverra.</p>', 'css' => VcTabsAdminFontAwesomeData('github')),
    2 => Array('id' => 3, 'styleid' => 14, 'title' => 'Default Title', 'files' => '<p>Sed ac auctor urna. Proin quis arcu quam. Nullam sit amet libero id metus laoreet rhoncus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus et lobortis justo. Donec tempus mollis porttitor. Nullam condimentum erat eu ullamcorper viverra.</p> <p>&nbsp;</p>  <p>Ut sed feugiat augue, vel ultricies dolor. Suspendisse consectetur dolor vitae orci placerat interdum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur nunc nisi, rutrum in laoreet a, accumsan ac elit. Aliquam lobortis eros ligula, eget volutpat dolor auctor sit amet. Nunc quis leo tortor. Nulla porta dictum nunc, quis laoreet nunc pretium quis. Duis luctus felis elit, ac blandit dui accumsan id. Quisque nibh magna, condimentum eget pharetra ut, finibus ac nunc. Fusce porttitor blandit felis, at pulvinar arcu accumsan sit amet. Pellentesque et gravida leo. Sed aliquam ac libero a pellentesque. Morbi nec auctor leo.</p>', 'css' => VcTabsAdminFontAwesomeData('adn')),
    3 => Array('id' => 4, 'styleid' => 14, 'title' => 'Default Title', 'files' => '<p>Ut sed feugiat augue, vel ultricies dolor. Suspendisse consectetur dolor vitae orci placerat interdum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur nunc nisi, rutrum in laoreet a, accumsan ac elit. Aliquam lobortis eros ligula, eget volutpat dolor auctor sit amet. Nunc quis leo tortor. Nulla porta dictum nunc, quis laoreet nunc pretium quis. Duis luctus felis elit, ac blandit dui accumsan id. Quisque nibh magna, condimentum eget pharetra ut, finibus ac nunc. Fusce porttitor blandit felis, at pulvinar arcu accumsan sit amet. Pellentesque et gravida leo. Sed aliquam ac libero a pellentesque. Morbi nec auctor leo.</p> <p>&nbsp;</p> <p>Fusce vel magna porta justo placerat molestie. Maecenas eleifend luctus tellus. Cras tincidunt condimentum mi, vel sagittis dui molestie a. Vivamus pretium accumsan blandit. Sed eu tincidunt ipsum, eu facilisis tellus. Suspendisse eget justo faucibus, malesuada sem et, lacinia elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer imperdiet nulla id sem semper, vitae egestas dolor rhoncus. Sed non arcu iaculis, eleifend dui id, tempor mauris. Cras eleifend volutpat pellentesque. Nulla vulputate magna id tortor interdum facilisis eu et metus. Proin id molestie libero, quis hendrerit quam. Ut quis urna non nisl suscipit malesuada et feugiat velit.</p>', 'css' => VcTabsAdminFontAwesomeData('ambulance'))
);
echo '<input type="hidden" name="oxi-tabs-data-' . $styledata['id'] . '" id="oxi-tabs-data-' . $styledata['id'] . '" value="' . $styledata['css'] . '">';
echo ctu_admin_style_layouts($styledata, $listdata);

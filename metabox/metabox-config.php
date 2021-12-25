<?php 

add_action('cmb2_admin_init', 'jr_metabox_fields_add');

function jr_metabox_fields_add(){

    $prefix = '_stfb_';

    $metaboxsec = new_cmb2_box(array(
        'title'         => __('Students Information', 'students-text-domain'),
        'id'            => 'student_info_fields',
        'object_types'   => array('jr_student_feedback')
    ));

    $metaboxsec->add_field(array(
        'name'          => __('Name', 'students-text-domain'),
        'type'          => 'text',
        'desc'          => 'Write your full name',
        'id'            => $prefix.'student_name' 
    ));
    $metaboxsec->add_field(array(
        'name'          => __('Class', 'students-text-domain'),
        'type'          => 'text',
        'desc'          => 'Student running class or semester',
        'id'            => $prefix.'student_class'
    ));
    $metaboxsec->add_field(array(
        'name'          => __('Department', 'students-text-domain'),
        'type'          => 'text',
        'desc'          => 'Select your department',
        'id'            => $prefix.'student_department'
    ));
    $metaboxsec->add_field(array(
        'name'          => __('Feedback', 'students-text-domain'),
        'desc'          => 'Please comment with your feedback.',
        'type'          => 'wysiwyg',
        'id'            => $prefix.'student_feedback'
    ));
}
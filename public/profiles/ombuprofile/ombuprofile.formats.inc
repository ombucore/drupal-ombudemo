<?php

 $formats = array (
  'comment' =>
  array (
    'format' => 'comment',
    'name' => 'Comment',
    'cache' => '1',
    'status' => '1',
    'weight' => '0',
    'filters' =>
    array (
      'filter_url' =>
      array (
        'format' => 'comment',
        'module' => 'filter',
        'name' => 'filter_url',
        'weight' => '0',
        'status' => '1',
        'settings' =>
        array (
          'filter_url_length' => 72,
        ),
        'title' => 'Convert URLs into links',
      ),
      'filter_html' =>
      array (
        'format' => 'comment',
        'module' => 'filter',
        'name' => 'filter_html',
        'weight' => '1',
        'status' => '1',
        'settings' =>
        array (
          'allowed_html' => '<a><u><em><strong><p>',
          'filter_html_help' => 1,
          'filter_html_nofollow' => 0,
        ),
        'title' => 'Limit allowed HTML tags',
      ),
      'filter_autop' =>
      array (
        'format' => 'comment',
        'module' => 'filter',
        'name' => 'filter_autop',
        'weight' => '2',
        'status' => '1',
        'settings' =>
        array (
        ),
        'title' => 'Convert line breaks into HTML (i.e. <code>&lt;br&gt;</code> and <code>&lt;p&gt;</code>)',
      ),
      'filter_htmlcorrector' =>
      array (
        'format' => 'comment',
        'module' => 'filter',
        'name' => 'filter_htmlcorrector',
        'weight' => '10',
        'status' => '1',
        'settings' =>
        array (
        ),
        'title' => 'Correct faulty and chopped off HTML',
      ),
      'filter_html_escape' =>
      array (
        'format' => 'comment',
        'module' => 'filter',
        'name' => 'filter_html_escape',
        'weight' => '10',
        'status' => '0',
        'settings' =>
        array (
        ),
        'title' => 'Display any HTML as plain text',
      ),
      'media_filter' =>
      array (
        'format' => 'comment',
        'module' => 'media',
        'name' => 'media_filter',
        'weight' => '10',
        'status' => '0',
        'settings' =>
        array (
        ),
        'title' => 'Convert Media tags to markup',
      ),
      'php_code' =>
      array (
        'format' => 'comment',
        'module' => 'php',
        'name' => 'php_code',
        'weight' => '10',
        'status' => '0',
        'settings' =>
        array (
        ),
        'title' => 'PHP evaluator',
      ),
    ),
  ),
  'default' =>
  array (
    'format' => 'default',
    'name' => 'Default',
    'cache' => '1',
    'status' => '1',
    'weight' => '0',
    'filters' =>
    array (
      'filter_html' =>
      array (
        'format' => 'default',
        'module' => 'filter',
        'name' => 'filter_html',
        'weight' => '0',
        'status' => '1',
        'settings' =>
        array (
          'allowed_html' => '<a><u><em><strong><ul><ol><li><span><img><h2><h3><h4><h5><h6><dl><dt><dd><br><hr><p><blockquote><table><th><tr><td>',
          'filter_html_help' => 1,
          'filter_html_nofollow' => 0,
        ),
        'title' => 'Limit allowed HTML tags',
      ),
      'media_filter' =>
      array (
        'format' => 'default',
        'module' => 'media',
        'name' => 'media_filter',
        'weight' => '1',
        'status' => '1',
        'settings' =>
        array (
        ),
        'title' => 'Convert Media tags to markup',
      ),
      'filter_url' =>
      array (
        'format' => 'default',
        'module' => 'filter',
        'name' => 'filter_url',
        'weight' => '2',
        'status' => '1',
        'settings' =>
        array (
          'filter_url_length' => '72',
        ),
        'title' => 'Convert URLs into links',
      ),
      'filter_autop' =>
      array (
        'format' => 'default',
        'module' => 'filter',
        'name' => 'filter_autop',
        'weight' => '3',
        'status' => '1',
        'settings' =>
        array (
        ),
        'title' => 'Convert line breaks into HTML (i.e. <code>&lt;br&gt;</code> and <code>&lt;p&gt;</code>)',
      ),
      'filter_htmlcorrector' =>
      array (
        'format' => 'default',
        'module' => 'filter',
        'name' => 'filter_htmlcorrector',
        'weight' => '10',
        'status' => '1',
        'settings' =>
        array (
        ),
        'title' => 'Correct faulty and chopped off HTML',
      ),
      'filter_html_escape' =>
      array (
        'format' => 'default',
        'module' => 'filter',
        'name' => 'filter_html_escape',
        'weight' => '10',
        'status' => '0',
        'settings' =>
        array (
        ),
        'title' => 'Display any HTML as plain text',
      ),
      'php_code' =>
      array (
        'format' => 'default',
        'module' => 'php',
        'name' => 'php_code',
        'weight' => '10',
        'status' => '0',
        'settings' =>
        array (
        ),
        'title' => 'PHP evaluator',
      ),
    ),
  ),
  'plain_text' =>
  array (
    'format' => 'plain_text',
    'name' => 'Plain text',
    'cache' => '1',
    'status' => '1',
    'weight' => '10',
    'filters' =>
    array (
      'filter_html_escape' =>
      array (
        'format' => 'plain_text',
        'module' => 'filter',
        'name' => 'filter_html_escape',
        'weight' => '0',
        'status' => '1',
        'settings' =>
        array (
        ),
        'title' => 'Display any HTML as plain text',
      ),
      'filter_url' =>
      array (
        'format' => 'plain_text',
        'module' => 'filter',
        'name' => 'filter_url',
        'weight' => '1',
        'status' => '1',
        'settings' =>
        array (
          'filter_url_length' => 72,
        ),
        'title' => 'Convert URLs into links',
      ),
      'filter_autop' =>
      array (
        'format' => 'plain_text',
        'module' => 'filter',
        'name' => 'filter_autop',
        'weight' => '2',
        'status' => '1',
        'settings' =>
        array (
        ),
        'title' => 'Convert line breaks into HTML (i.e. <code>&lt;br&gt;</code> and <code>&lt;p&gt;</code>)',
      ),
      'filter_html' =>
      array (
        'format' => 'plain_text',
        'module' => 'filter',
        'name' => 'filter_html',
        'weight' => '10',
        'status' => '0',
        'settings' =>
        array (
          'allowed_html' => '<a> <em> <strong> <cite> <blockquote> <code> <ul> <ol> <li> <dl> <dt> <dd>',
          'filter_html_help' => 1,
          'filter_html_nofollow' => 0,
        ),
        'title' => 'Limit allowed HTML tags',
      ),
      'filter_htmlcorrector' =>
      array (
        'format' => 'plain_text',
        'module' => 'filter',
        'name' => 'filter_htmlcorrector',
        'weight' => '10',
        'status' => '0',
        'settings' =>
        array (
        ),
        'title' => 'Correct faulty and chopped off HTML',
      ),
      'media_filter' =>
      array (
        'format' => 'plain_text',
        'module' => 'media',
        'name' => 'media_filter',
        'weight' => '10',
        'status' => '0',
        'settings' =>
        array (
        ),
        'title' => 'Convert Media tags to markup',
      ),
      'php_code' =>
      array (
        'format' => 'plain_text',
        'module' => 'php',
        'name' => 'php_code',
        'weight' => '10',
        'status' => '0',
        'settings' =>
        array (
        ),
        'title' => 'PHP evaluator',
      ),
    ),
  ),
  'php_code' =>
  array (
    'format' => 'php_code',
    'name' => 'PHP code',
    'cache' => '0',
    'status' => '1',
    'weight' => '11',
    'filters' =>
    array (
      'php_code' =>
      array (
        'format' => 'php_code',
        'module' => 'php',
        'name' => 'php_code',
        'weight' => '0',
        'status' => '1',
        'settings' =>
        array (
        ),
        'title' => 'PHP evaluator',
      ),
      'filter_autop' =>
      array (
        'format' => 'php_code',
        'module' => 'filter',
        'name' => 'filter_autop',
        'weight' => '10',
        'status' => '0',
        'settings' =>
        array (
        ),
        'title' => 'Convert line breaks into HTML (i.e. <code>&lt;br&gt;</code> and <code>&lt;p&gt;</code>)',
      ),
      'filter_html' =>
      array (
        'format' => 'php_code',
        'module' => 'filter',
        'name' => 'filter_html',
        'weight' => '10',
        'status' => '0',
        'settings' =>
        array (
          'allowed_html' => '<a> <em> <strong> <cite> <blockquote> <code> <ul> <ol> <li> <dl> <dt> <dd>',
          'filter_html_help' => 1,
          'filter_html_nofollow' => 0,
        ),
        'title' => 'Limit allowed HTML tags',
      ),
      'filter_htmlcorrector' =>
      array (
        'format' => 'php_code',
        'module' => 'filter',
        'name' => 'filter_htmlcorrector',
        'weight' => '10',
        'status' => '0',
        'settings' =>
        array (
        ),
        'title' => 'Correct faulty and chopped off HTML',
      ),
      'filter_html_escape' =>
      array (
        'format' => 'php_code',
        'module' => 'filter',
        'name' => 'filter_html_escape',
        'weight' => '10',
        'status' => '0',
        'settings' =>
        array (
        ),
        'title' => 'Display any HTML as plain text',
      ),
      'filter_url' =>
      array (
        'format' => 'php_code',
        'module' => 'filter',
        'name' => 'filter_url',
        'weight' => '10',
        'status' => '0',
        'settings' =>
        array (
          'filter_url_length' => 72,
        ),
        'title' => 'Convert URLs into links',
      ),
      'media_filter' =>
      array (
        'format' => 'php_code',
        'module' => 'media',
        'name' => 'media_filter',
        'weight' => '10',
        'status' => '0',
        'settings' =>
        array (
        ),
        'title' => 'Convert Media tags to markup',
      ),
    ),
  ),
);


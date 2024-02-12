<?php

$config = new PhpCsFixer\Config();
return $config->setRules([
    '@PSR2'                  => true,
    'array_syntax'           => ['syntax' => 'short'],
    'binary_operator_spaces' => [
        'default' => 'align_single_space_minimal',
    ],
    'concat_space'          => ['spacing' => 'one'],
    'indentation_type'      => true,
    'line_ending'           => true,
    'method_argument_space' => [
        'on_multiline'                     => 'ensure_fully_multiline',
        'keep_multiple_spaces_after_comma' => true,
    ],
    'no_leading_import_slash'               => true,
    'no_trailing_comma_in_list_call'        => true,
    'no_trailing_comma_in_singleline_array' => true,
    'no_whitespace_before_comma_in_array'   => true,
    'whitespace_after_comma_in_array'       => true,
    'not_operator_with_successor_space'     => true,
    'not_operator_with_space'               => false,
    'object_operator_without_whitespace'    => true,
    'single_blank_line_before_namespace'    => true,
    'trailing_comma_in_multiline'           => ['elements' => ['arrays', 'arguments', 'parameters']],
    'trim_array_spaces'                     => true,
    'unary_operator_spaces'                 => true,
    'visibility_required'                   => ['elements' => ['method', 'property']],
    'phpdoc_align'                          => ['align' => 'left'],
    'phpdoc_indent'                         => true,
    'phpdoc_scalar'                         => true,
    'phpdoc_summary'                        => false,
    'phpdoc_to_comment'                     => false,
    'phpdoc_trim'                           => true,
    'phpdoc_types'                          => true,
    'phpdoc_var_without_name'               => false,
])->setFinder(PhpCsFixer\Finder::create()->in(dirname(__DIR__))->exclude('vendor'));

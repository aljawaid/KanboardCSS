// Stylelint flat configuration for Super-Linter v9 and Stylelint 17.
export default {
  extends: ['stylelint-config-standard'],
  rules: {
    'alpha-value-notation': 'number',
    'at-rule-no-vendor-prefix': null,
    'color-function-notation': 'legacy',
    'color-hex-length': ['long', {severity: 'warning'}],
    'color-no-invalid-hex': true,
    'comment-empty-line-before': [
      'always',
      {except: ['first-nested'], ignore: ['after-comment'], severity: 'warning'}
    ],
    'comment-whitespace-inside': ['always', {severity: 'warning'}],
    'declaration-block-no-redundant-longhand-properties': [true, {severity: 'warning'}],
    'declaration-block-single-line-max-declarations': null,
    'declaration-no-important': null,
    'font-family-name-quotes': 'always-where-recommended',
    'font-family-no-missing-generic-family-keyword': [
      true,
      {ignoreFontFamilies: ['FontAwesome'], severity: 'warning'}
    ],
    'font-weight-notation': 'named-where-possible',
    'length-zero-no-unit': true,
    'media-feature-range-notation': null,
    'no-descending-specificity': null,
    'number-max-precision': 5,
    'property-no-vendor-prefix': null,
    'selector-class-pattern': null,
    'selector-id-pattern': null,
    'selector-no-vendor-prefix': null,
    'selector-type-case': 'lower',
    'shorthand-property-no-redundant-values': null,
    'value-keyword-case': [
      'lower',
      {ignoreProperties: ['/^(b|B)ackground$/', 'text-rendering']}
    ],
    'value-no-vendor-prefix': null
  }
};

# Lexicon Data Stracture

## One entry

- pronunciation
- unicode
- translit
- definition
  - This contains othre lexicon entries' references.
    - They must be linked when displayed.
  - The loongest text with some special characters.
    - Data type will be **TEXT**.
- strongs_number

pronunciation VARCHAR(64) NULL
unicode VARCHAR(64) NULL
translit VARCHAR(64) NULL
definition TEXT NULL
strongs_number VARCHAR(8) PK

Lexicon done.
# PHP-colorQR
PHP-colorQR is a concept color QR barcode generator.

# Color Palette 
The Color QR barcode will utilize an 8 color palette. Consisting of:

- White
- Black
- Red
- Orange
- Yellow
- Green
- Cyan
- Magenta

# Encoding
Data is encoded into color pairs. A normal color pair is used where the characters fall within the range A-Za-z0-9. 

Where a character falls out of range a reserved color pair delimeter will be used to denote data encoded in base62().

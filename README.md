# PHP-colorQR
PHP-colorQR is a concept color QR barcode generator.

# CSS color map
The Color QR barcode utilizes an 8 color palette. 

The Color QR pallette will be mapped to the following css colors:

- white
- black
- red
- orange
- yellow
- green
- blue
- pink


# Encoding
Data is encoded into color pairs. A normal color pair is used where the characters fall within the range A-Za-z0-9. 

Where a character falls out of range a reserved color pair delimeter will be used to denote data encoded in base62().

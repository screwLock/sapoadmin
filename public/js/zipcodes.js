function validZip(zip) {
    var reUS = /^([0-9]{5})(?:[-\s]*([0-9]{4}))?$/, // US Zip
        reCA = /^([A-Z][0-9][A-Z])\s*([0-9][A-Z][0-9])$/; // CA Zip
  
    return zip.match(reUS) || zip.match(reCA);
  }
// filter

// app.filter('getMetaStatus', () => {
//  return (tempSpace, meta_title, meta_description, meta_keywords, itemprop_url, og_url, og_image, twitter_card, twitter_site, twitter_image) => {
//         meta_title = (meta_title == null) ? '' : meta_title;
//         meta_description = (meta_description == null) ? '' : meta_description;
//         meta_keywords = (meta_keywords == null) ? '' : meta_keywords;
//
//         meta_title = (meta_title.length !== 0) ? 1 : 0;
//         meta_description = (meta_description.length !== 0) ? 1 : 0;
//         meta_keywords = (meta_keywords.length !== 0) ? 1 : 0;
//
//         const status = meta_title + meta_description + meta_keywords;
//
//         itemprop_url = (itemprop_url == null) ? '' : itemprop_url;
//         og_url = (og_url == null) ? '' : og_url;
//         og_image = (og_image == null) ? '' : og_image;
//         twitter_card = (twitter_card == null) ? '' : twitter_card;
//         twitter_site = (twitter_site == null) ? '' : twitter_site;
//         twitter_image = (twitter_image == null) ? '' : twitter_image;
//
//         itemprop_url = (itemprop_url.length !== 0) ? 1 : 0;
//         og_url = (og_url.length !== 0) ? 1 : 0;
//         og_image = (og_image.length !== 0) ? 1 : 0;
//         twitter_card = (twitter_card.length !== 0) ? 1 : 0;
//         twitter_site = (twitter_site.length !== 0) ? 1 : 0;
//         twitter_image = (twitter_image.length !== 0) ? 1 : 0;
//
//         const statusOther = itemprop_url+og_url+og_image+twitter_card+twitter_site+twitter_image;
//
//
//      colorClass = {
//             0: 'text-disabled-gray',
//             1: 'text-danger',
//             2: 'text-warning',
//             3: 'text-primary',
//             4: 'text-success',
//         }
//         className = (colorClass[status] !== undefined) ? colorClass[status] : 'text-disabled-gray';
//         className = (status === 3 && statusOther === 6) ? colorClass[4] : className;
//         return className;
//  };
// });

app.filter('getShortAvatarName', () => {
    return (name) => {
        if (!name) { return name}
        name = name.split(' ');
        if (name.length >= 2) {
            name = name[0].charAt(0) + name[1].charAt(0);
        } else {
            name = name[0].substring(0, 2);
        }
        return name;
    };
});

app.filter('getLength', () => {
    return (string) => {
        string = string === null ? '' : string;
        return string.length;
    };
});

// app.filter('slugify', () => {
//  return (string) => {
//         if (!string) {return;}
//         let slug = string.toLowerCase().trim();
//         slug = slug.replace(/[^a-z0-9\s-]/g, ' ');
//         slug = slug.replace(/[\s-]+/g, '-');
//         return slug;
//  };
// });

app.filter('capitalize', function() {
    return function(input) {
      return (angular.isString(input) && input.length > 0) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : input;
    }
});

app.filter('makeHighlight', () => {
    return (text, search, commonSearch = null) => {
        if (!search && !commonSearch) {return text;}
        params = commonSearch ? commonSearch : search;
        if (text === undefined || text === null ) { return text;}
        text = text.toString();
        return text.replace(new RegExp(params, 'gi'), '<i class="makeHighlight">$&</i>');
    };
});


// app.filter('filterCommaSeparated', function () {
//     return function (input, val, isFound = 1) {
//         if (val === undefined) {
//             return input;
//         }
//         uniqueObjIndex = [];
//         var outObj = [];
//         key = Object.keys(val)[0];
//         notFoundList = 'Not Found: ';
//         isNotFoundShow = 0;
//         var filterVal = val[key].split(',');
//         for (var filterValIndex in filterVal) {
//             isNotFound = 1;
//             for (var objIndex in input) {
//                 if (input[objIndex][key].toLowerCase().includes(filterVal[filterValIndex].trim().toLowerCase()) && !uniqueObjIndex.includes(objIndex)) {
//                     outObj.push(input[objIndex]);
//                     uniqueObjIndex.push(objIndex);
//                     isNotFound = 0;
//                 }
//             }
//             if (isNotFound) {
//                 isNotFoundShow = 1;
//                 notFoundList = notFoundList + filterVal[filterValIndex].trim()+', ';
//             }
//         }
//         notFoundList = isNotFoundShow ? notFoundList : null;
//         return isFound ? outObj : notFoundList;
//         // return outObj;
//     }
// });

app.filter('getDateFormat', () => {
    return (timestamp) => {
        if(!timestamp) {return timestamp;}
        timestamp = timestamp.split('-');
        return timestamp[2]+'-'+timestamp[1]+'-'+timestamp[0];
    };
});

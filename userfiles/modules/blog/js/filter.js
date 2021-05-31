/*jshint esversion: 6 */

class ContentFilter {

    setModuleId(moduleId) {
        this.moduleId = moduleId;
    };

    replaceKeyValuesAndReloadFilter(queryParams) {

        // Update values for keys in URL QUERY

        var redirectFilterUrl = getUrlAsArray();

        var i;
        for (i = 0; i < queryParams.length; i++) {
            redirectFilterUrl = findOrReplaceInObject(redirectFilterUrl, queryParams[i].key, queryParams[i].value);
        }

        this.reloadFilter(redirectFilterUrl);
    };

    reloadFilter(redirectFilterUrl) {

        mw.spinner({
            element: $('#'+this.moduleId+ ''),
            size:"500px",
            decorate: false
        }).show();

        $('#'+this.moduleId+ '').attr('ajax_filter', encodeDataToURL(redirectFilterUrl));
        mw.reload_module('#'+this.moduleId+ '');
        window.history.pushState('', false, '?' + encodeDataToURL(redirectFilterUrl));

        //window.location = "{!! $searchUri !!}" + keywordField.value;
    };

    init() {

        var filterInstance = this;

        // Active filters
        $('body').on('click' , '.js-filter-active-filters' , function() {

            var keys = $(this).data('key');
            var removeKeys = keys.split(',');

            var redirectFilterUrl = getUrlAsArray();

            for (var i = 0; i < removeKeys.length; i++) {
                var filterKey = removeKeys[i];
                filterKey = filterKey.trim();
                redirectFilterUrl = removeItemByKeyInObject(redirectFilterUrl, filterKey);
            }

            filterInstance.reloadFilter(redirectFilterUrl);

        });

        // Limit
        $('body').on('change' , '.js-filter-change-limit' , function() {

            $(this).attr('disabled','disabled');

            var queryParams = [];

            var limit = $(".js-filter-change-limit").val();
            queryParams.push({
                key:'limit',
                value:limit
            });

            filterInstance.replaceKeyValuesAndReloadFilter( queryParams);
        });

        // Sort
        $('body').on('change' , '.js-filter-change-sort' , function() {

            $(this).attr('disabled','disabled');

            var queryParams = [];

            var sort = $(".js-filter-change-sort").children('option:selected').attr('data-sort');
            queryParams.push({
                key:'sort',
                value:sort
            });

            var order = $(".js-filter-change-sort").children('option:selected').attr('data-order');
            queryParams.push({
                key:'order',
                value:order
            });

            filterInstance.replaceKeyValuesAndReloadFilter(queryParams);
        });

        // Custom fields
        $('body').on('change', '.js-filter-option-select', function(e) {

            var redirectFilterUrl = getUrlAsArray();

            redirectFilterUrl = redirectFilterUrl.filter(function(e) {
                var elementKey = e.key;
                if (elementKey.indexOf("[]")) {
                    return false;
                }
            });

           var filterForm = $('.js-filter-form').serializeArray();
            $.each(filterForm, function(k, field) {
                var fieldName = field.name;
              //  console.log(fieldName);
                if (fieldName.indexOf("[]")) {
                    redirectFilterUrl.push({key: field.name, value: field.value});
                } else {
                    redirectFilterUrl = findOrReplaceInObject(redirectFilterUrl, field.name, field.value);
                }
            });

           // console.log(redirectFilterUrl);

            filterInstance.reloadFilter(redirectFilterUrl);
        });

        // Search
        $(document).keypress(function(e) {
            if(e.which == 13) {
               $('.js-filter-search-field').trigger('change');
            }
        });

        $('body').on('submit', '.js-filter-search-submit', function(e) {

            $(this).attr('disabled','disabled');

            $('.js-filter-search-field').trigger('change');
        });

        $('body').on('change', '.js-filter-search-field', function(e) {

            $(this).attr('disabled','disabled');

            var redirectFilterUrl = getUrlAsArray();
            redirectFilterUrl = findOrReplaceInObject(redirectFilterUrl, 'search', $('.js-filter-search-field').val());
            redirectFilterUrl = removeItemByKeyInObject(redirectFilterUrl,'page');

            filterInstance.reloadFilter(redirectFilterUrl);
        });

        // Categories
        $('body').on('click', '.js-filter-category-link', function(e) {
            e.preventDefault();
            var targetPageNum = $(this).attr('href').split('category=')[1];
            var queryParams = [];
            queryParams.push({
                key:'category',
                value:targetPageNum
            });
            filterInstance.replaceKeyValuesAndReloadFilter(queryParams);
        });

        // Pagination
        $('body').on('click', '.page-link', function(e) {
            e.preventDefault();
            $(this).attr('disabled','disabled');

            var targetPageNum = $(this).attr('href').split('page=')[1];
            var queryParams = [];
            queryParams.push({
                key:'page',
                value:targetPageNum
            });
            filterInstance.replaceKeyValuesAndReloadFilter(queryParams);
        });

    };
}


function removeItemByKeyInObject(object, key) {

    for (var i = 0; i < object.length; i++) {
        if (object[i].key == key) {
            object.splice(i, 1);
        }
    }

    return object;
}

function findOrReplaceInObject(object, key, value) {
    var findKey = false;
    for (var i = 0; i < object.length; i++) {
        if (object[i].key === key) {
            object[i].value = value;
            findKey = true;
            break;
        }
    }
    if (findKey === false) {
        object.push({key: key, value: value});
    }
    return object;
}

function decodeUrlParamsToObject(url) {
    if (url.indexOf('?') === -1) {
        return [];
    }
    var request = [];
    var pairs = url.substring(url.indexOf('?') + 1).split('&');
    for (var i = 0; i < pairs.length; i++) {
        if (!pairs[i])
            continue;
        var pair = pairs[i].split('=');
        request.push({key: decodeURIComponent(pair[0]), value: decodeURIComponent(pair[1])});
    }
    return request;
}

function getUrlAsArray() {
    return decodeUrlParamsToObject(location.href);
}

const encodeDataToURL = (data) => {
    return data.map(value => `${value.key}=${encodeURIComponent(value.value)}`).join('&');
};


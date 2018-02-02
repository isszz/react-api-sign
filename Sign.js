import md5 from 'md5';

function time(params: Object) {
    let time = Date.parse( new Date() ).toString();
    return time.substr(0, 10);
}

function sign(params: Object) {

    if(!params.timestamp) {
        params.timestamp = time();
    }

    let keys = Object.keys(params).sort();
    let sorted = {};

    for (let k in keys) {
        sorted[keys[k]] = params[keys[k]];
    }
    
    let string = Object.keys(sorted).map(key => {
        let v = sorted[key];
        if(key != 'sign' && v != '' && typeof(v) != Object) {
            return key + '=' + v;
        }
    }).join('&');

    string += 'secret=kjhsdfhksjhf239ur2hfehf23'; // Replace with your secret
    string = md5(string);
    return string.toUpperCase();
}

export function url(url: string, params: Object, isUnSign: boolean) {
    let result = url
    if (result.substr(result.length - 1) != '?') {
        result = result + `?`
    }

    // unset sign
    if(!isUnSign) {
        params.sign = sign(params);
    }
    
    for (let key in params) {
        let value = params[key]
        result += `${encodeURIComponent(key)}=${encodeURIComponent(value)}&`
    }

    result = result.substring(0, result.length - 1);
    console.log(result);
    return result;
}

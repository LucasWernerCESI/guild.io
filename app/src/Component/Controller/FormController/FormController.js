export function FormController ( values, errors ) {

    // Form check
    let isFormRdy = true;

    for ( const [key, value] of Object.entries( values ) ) {

        console.log( errors[key] )

        // Check for empty inputs
        if ( value === '' ) {
            console.log(key + " empty input")
            /* setErrors({
                ...errors,
                [key]: true
            }); */
            errors[key] = true;
            isFormRdy = false;
        }
        // Check for coherent mail
        else if ( key === "mail" ) {
            if ( value.search('@') < 0 ) {
                /* setErrors({
                    ...errors,
                    [key]: true
                }); */
                errors[key] = true;
                isFormRdy = false;
            } else {
                errors[key] = false;
            }
        }
        // Check for coherent mail
        else if ( key === "passwordConfirm" ) {
            if ( value !== values.password ) {
                /* setErrors({
                    ...errors,
                    [key]: true
                }); */
                errors[key] = true;
                isFormRdy = false;
            } else {
                errors[key] = false;
            }
        } else {
            errors[key] = false;
        }
    }

    return {
        isFormRdy: isFormRdy,
        errors: errors
    }

}
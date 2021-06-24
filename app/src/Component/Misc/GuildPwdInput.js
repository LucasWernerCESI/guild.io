import {FormControl, IconButton, InputAdornment, InputLabel, OutlinedInput} from "@material-ui/core";
import {makeStyles} from "@material-ui/styles";
import {Visibility, VisibilityOff} from "@material-ui/icons";
import React from 'react';

const useStyles = makeStyles(( theme ) => ({
    guildInput: {
        marginTop: theme.spacing(1),
        marginBottom: theme.spacing(1),
    }
}));

export function GuildPwdInput ( { label, labelWidth, ...props }) {

    const classes = useStyles();
    const [values, setValues] = React.useState({
        password: '',
        showPassword: false
    });

    const handleChange = prop => ev => {
        setValues({ ...values, [prop]: ev.target.value });
    };

    const handleClickShowPassword = () => {
        setValues({ ...values, showPassword: !values.showPassword });
    };

    const handleMouseDownPassword = ev => {
        ev.preventDefault();
    };

    return (
        <FormControl fullWidth size={ "small" } variant={ "outlined" } className={ classes.guildInput }>
            <InputLabel size={ "small" } htmlFor={ label + "PwdInput" }>{ label }</InputLabel>
            <OutlinedInput
                size={ "small" }
                id={ label + "PwdInput" }
                type={ values.showPassword ? 'text' : 'password' }
                value={ values.password }
                onChange={ handleChange( 'password' ) }
                endAdornment={
                    <InputAdornment position="end">
                        <IconButton
                            aria-label="toggle password visibility"
                            onClick={ handleClickShowPassword }
                            onMouseDown={ handleMouseDownPassword }
                        >
                            { values.showPassword ? <Visibility /> : <VisibilityOff /> }
                        </IconButton>
                    </InputAdornment>
                }
                labelWidth={ labelWidth }
                fullWidth
                {...props}
            />
        </FormControl>
    )
}
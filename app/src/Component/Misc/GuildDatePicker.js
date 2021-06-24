import React from 'react';
import { KeyboardDatePicker, MuiPickersUtilsProvider } from '@material-ui/pickers';
import DateFnsUtils from '@date-io/date-fns';
import { makeStyles } from "@material-ui/styles";

const useStyles = makeStyles(( theme ) => ({
    guildInput: {
        marginTop: theme.spacing(1),
        marginBottom: theme.spacing(1),
    }
}));

export function GuildDatePicker ( { label, ...props } ) {

    const classes = useStyles();

    const [selectedDate, setSelectedDate] = React.useState( new Date() );

    const handleDateChange = (date) => {
        setSelectedDate(date);
    };

    return (
        <MuiPickersUtilsProvider utils={DateFnsUtils}>
            <KeyboardDatePicker
                className={ classes.guildInput }
                margin="normal"
                id="date-picker-dialog"
                label={ label }
                format="dd/MM/yyyy"
                value={ selectedDate }
                onChange={ handleDateChange }
                KeyboardButtonProps={{
                    'aria-label': 'change date',
                }}
                inputVariant={"outlined"}
                size={"small"}
                fullWidth
                {...props}
            />
        </MuiPickersUtilsProvider>
    )

}
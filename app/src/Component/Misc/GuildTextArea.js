import {TextField} from "@material-ui/core";
import {makeStyles} from "@material-ui/styles";

const useStyles = makeStyles(( theme ) => ({
    guildInput: {
        marginTop: theme.spacing(1),
        marginBottom: theme.spacing(1),
    }
}));

export function GuildTextArea ( { label, rows, ...props } ) {

    const classes = useStyles();

    return (
        <TextField
            className={classes.guildInput}
            size={"small"}
            label={ label }
            variant="outlined"
            fullWidth
            multiline
            rows={rows}
            {...props}
        />
    )
}
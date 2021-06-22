import './App.css';
import React from 'react';
import { createMuiTheme, ThemeProvider } from '@material-ui/core/styles';
import {
    BrowserRouter as Router,
    Switch,
    Route
} from "react-router-dom";
import { Home } from "./Component/Layout/Home.js";
import { Container, CssBaseline, useMediaQuery } from "@material-ui/core";
import { GuildNavBar } from "./Component/Global/GuildNavBar/GuildNavBar";
import { fade } from '@material-ui/core/styles/colorManipulator';
import { GuildFooter } from "./Component/Global/GuildFooter/GuildFooter";
import { Login } from "./Component/Layout/Login";
import { Register } from "./Component/Layout/Register";
import { Guild } from "./Component/Layout/Guild";
import { Application } from "./Component/Layout/Application";
import { User } from "./Component/Layout/User";
import { Support } from "./Component/Layout/Support";

function App() {

    const prefersDarkMode = useMediaQuery('(prefers-color-scheme: dark)');

    const theme = React.useMemo( () => createMuiTheme({
                palette: {
                    type: 'light',
                    text: {
                        primary: "#FFFFFF",
                        secondary: fade("#FFFFFF", .75),
                        disabled: fade("#FFFFFF", .5)
                    },
                    divider: fade("#FFFFFF", .15),
                    primary: {
                        main: "#B9E464"
                    },
                    secondary: {
                        main: "#FFFFFF"
                    },
                    background: {
                        default: "#464646",
                        paper: "#464646"
                    }
                }
            }
        ),
        [prefersDarkMode]
    )

    return (

        <ThemeProvider theme={theme}>

            <CssBaseline/>
            <Router>

                <GuildNavBar/>

                <Container>

                    <Switch>

                        <Route exact path="/">
                            <Home/>
                        </Route>

                        <Route exact path="/login">
                            <Login/>
                        </Route>

                        <Route exact path="/register">
                            <Register/>
                        </Route>

                        <Route exact path="/guild">
                            <Guild/>
                        </Route>

                        <Route exact path="/application">
                            <Application/>
                        </Route>

                        <Route exact path="/user">
                            <User/>
                        </Route>

                        <Route exact path="/support">
                            <Support/>
                        </Route>

                    </Switch>

                </Container>

            </Router>
            <GuildFooter/>

        </ThemeProvider>

    );
}

export default App;
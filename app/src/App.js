import './App.css';
import React from 'react';
import { createMuiTheme, ThemeProvider } from '@material-ui/core/styles';
import {
    BrowserRouter as Router,
    Switch,
    Route
} from "react-router-dom";
import { Home } from "./Component/Layout/Home.js";
import { Container, CssBaseline, Grid, useMediaQuery } from "@material-ui/core";
import { GuildNavBar } from "./Component/Global/GuildNavBar/GuildNavBar";
import { fade } from '@material-ui/core/styles/colorManipulator';
import { GuildFooter } from "./Component/Global/GuildFooter/GuildFooter";
import { Login } from "./Component/Layout/Login/Login";
import { Register } from "./Component/Layout/Register/Register";
import { Guild } from "./Component/Layout/Guild";
import { Application } from "./Component/Layout/Application/Application";
import { User } from "./Component/Layout/User";
import { Support } from "./Component/Layout/Support/Support";
import { NotFound } from "./Component/Layout/NotFound";
import { AuthStatusController } from "./Component/Controller/AuthStatusController/AuthStatusController";

function App() {

    localStorage.clear();

    AuthStatusController();

    // DarkMode and Material Theming
    const prefersDarkMode = useMediaQuery('(prefers-color-scheme: dark)');

    const theme = React.useMemo( () => createMuiTheme({
                palette: {
                    type: 'dark',
                    text: {
                        primary: fade("#FFFFFF", .75),
                        secondary: fade("#FFFFFF", .5),
                        disabled: fade("#FFFFFF", .25)
                    },
                    divider: fade("#FFFFFF", .15),
                    primary: {
                        main: "#B9E464",
                        contrastText: "#464646"
                    },
                    secondary: {
                        main: "#464646"
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

        <ThemeProvider
            theme={theme}
        >

            <CssBaseline/>
            <Router>

                <GuildNavBar
                    pageList={["home", "guild", "support"]}
                />

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

                        <Route exact path="/application/:guildId">
                            <Application/>
                        </Route>

                        <Route exact path="/user">
                            <User/>
                        </Route>

                        <Route exact path="/support">
                            <Support/>
                        </Route>

                        <Route component={NotFound} />

                    </Switch>

                </Container>

            </Router>
            <GuildFooter/>

        </ThemeProvider>

    );
}

export default App;
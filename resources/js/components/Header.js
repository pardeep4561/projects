import React from 'react';

const ClickMe = ()=>{

    console.log('hello');
}

const Header = () =>{

    return(
        <h1 onClick={ClickMe}>Hello</h1>
    )
}

export default Header;

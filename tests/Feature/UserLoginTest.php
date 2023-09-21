<?php

it('has userlogin page', function () {
    $response = $this->get('/userlogin');

    $response->assertStatus(200);
});


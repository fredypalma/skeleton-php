import {defineFeature,loadFeature} from "jest-cucumber";

const feature = loadFeature('./tests/apps/bc/frontend/features/health_check.feature');

defineFeature(feature, test => {
    test('Check the api status', ({ given, then }) => {
        given(/^I send a GET request to "(.*)"$/, (arg0) => {
            throw Error('Pendiente');
        });

        then('the response content should be:', (docString) => {
            throw Error('Pendiente');
        });
    });

});
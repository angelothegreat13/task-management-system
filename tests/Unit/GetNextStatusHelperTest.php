<?php

use Illuminate\Support\Facades\Config;

uses(Tests\TestCase::class);

beforeEach(function () {
    Config::set('task.status_sequence', [
        'New',
        'In Progress',
        'Under Review',
        'Completed',
    ]);
});

it('returns the next status when current status is valid', function () {
    $currentStatus = 'New';
    $expectedNextStatus = 'In Progress';

    expect(getNextStatus($currentStatus))->toBe($expectedNextStatus);
});

it('returns null when current status is the last one in the sequence', function () {
    $currentStatus = 'Completed';

    expect(getNextStatus($currentStatus))->toBeNull();
});

it('returns null for an invalid status that is not in the sequence', function () {
    $currentStatus = 'Archived';

    expect(getNextStatus($currentStatus))->toBeNull();
});

it('returns null when the status sequence is empty', function () {
    Config::set('task.status_sequence', []);

    $currentStatus = 'Under Review';

    expect(getNextStatus($currentStatus))->toBeNull();
});
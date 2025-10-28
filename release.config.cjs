module.exports = {
    branches: ['main'],
    plugins: [
        ['@semantic-release/commit-analyzer', { preset: 'angular' }],
        ['@semantic-release/release-notes-generator', { preset: 'angular' }],
        ['@semantic-release/changelog', { changelogFile: 'CHANGELOG.md' }]
    ]
};

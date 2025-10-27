module.exports = {
    branches: ['main'], // tu rama principal
    plugins: [
        ['@semantic-release/commit-analyzer', {
            preset: 'angular' // compatible con Conventional Commits
        }],
        ['@semantic-release/release-notes-generator', {
            preset: 'angular'
        }],
        ['@semantic-release/changelog', {
            changelogFile: 'CHANGELOG.md'
        }]
    ]
};

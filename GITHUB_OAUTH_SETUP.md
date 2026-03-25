# GitHub OAuth Configuration
# 
# Steps to setup GitHub OAuth:
# 1. Go to https://github.com/settings/developers
# 2. Click "New OAuth App"
# 3. Fill in Application Name, Homepage URL, Application Description
# 4. Set Authorization callback URL to: http://localhost:8000/auth/github/callback (for local development)
# 5. For production: https://yourdomain.com/auth/github/callback
# 6. Copy Client ID and Client Secret and add them below
# 7. Run: php artisan migrate

GITHUB_CLIENT_ID=your_github_client_id_here
GITHUB_CLIENT_SECRET=your_github_client_secret_here
GITHUB_REDIRECT_URI=http://localhost:8000/auth/github/callback

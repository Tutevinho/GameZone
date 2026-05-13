from http.server import HTTPServer, SimpleHTTPRequestHandler
import json


state = {}  # { "1": {"expira": 1711234567, "nombre": "PCGaming1"}, ... }


class Handler(SimpleHTTPRequestHandler):


    def do_GET(self):
        if self.path == '/state':
            self.send_response(200)
            self.send_header('Content-Type', 'application/json')
            self.send_header('Access-Control-Allow-Origin', '*')
            self.end_headers()
            self.wfile.write(json.dumps(state).encode())
        else:
            super().do_GET()


    def do_POST(self):
        if self.path == '/update':
            length = int(self.headers['Content-Length'])
            data = json.loads(self.rfile.read(length))
            state.update(data)
            self.send_response(200)
            self.send_header('Access-Control-Allow-Origin', '*')
            self.end_headers()


    def log_message(self, *args): pass


print("Servidor en http://0.0.0.0:8000")
HTTPServer(('0.0.0.0', 8000), Handler).serve_forever(

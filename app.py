from flask import Flask, jsonify, request

app = Flask(__name__)

@app.route('/print', methods=['POST'])
def print_voucher():
    # Implement your printing logic here
    # For demonstration, we're returning a success response
    return jsonify({'success': True})

if __name__ == '__main__':
    app.run(host='127.0.0.1', port=5000)
